<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHotelRequest;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HotelController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hotel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Hotel::with(['country', 'city'])->select(sprintf('%s.*', (new Hotel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'hotel_show';
                $editGate      = 'hotel_edit';
                $deleteGate    = 'hotel_delete';
                $crudRoutePart = 'hotels';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country', 'city']);

            return $table->make(true);
        }
                $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
                $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
         
                return view('admin.hotels.index', compact('cities', 'countries'));
        // return view('admin.hotels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hotel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hotels.create', compact('cities', 'countries'));
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $hotel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hotel->id]);
        }

        return redirect()->route('admin.hotels.index')->with('success', trans('global.success_Create_Message'));
    }

    public function edit(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hotel->load('country', 'city');

        return view('admin.hotels.edit', compact('cities', 'countries', 'hotel'));
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->all());

        if (count($hotel->photos) > 0) {
            foreach ($hotel->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $hotel->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $hotel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.hotels.index')->with('success', trans('global.success_Edit_Message'));
    }

    public function show(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotel->load('country', 'city');

        return view('admin.hotels.show', compact('hotel'));
    }

    public function destroy(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotel->delete();

        return back();
    }

    public function massDestroy(MassDestroyHotelRequest $request)
    {
        $hotels = Hotel::find(request('ids'));

        foreach ($hotels as $hotel) {
            $hotel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hotel_create') && Gate::denies('hotel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Hotel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
