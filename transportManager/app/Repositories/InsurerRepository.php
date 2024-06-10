<?php

namespace App\Repositories;

use App\Filter\Title;
use App\Interfaces\RepositoryInterface;
use App\Models\Insurer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsurerRepository implements RepositoryInterface
{
    private function query(): \Illuminate\Database\Eloquent\Builder
    {
        $query=Insurer::query();
                return $query;
    }

    public static function FindByField($field, $value)
    {
        return (new self)->query()->where($field, $value)->first();
    }

    public static function GetByField($field, $value)
    {
        return (new self)->query()->where($field, $value)->get();
    }

    public static function FindById($id)
    {

        return (new self)->query()->where('id', $id)->first();
    }

    static function NewItem($data,$addUserCreatorId=true): \Illuminate\Database\Eloquent\Model
    {
        return Insurer::create($data);
    }
    static function UpdateItem($data, $id): int
    {
        $record = (new self )->FindByField("id",$id);
        foreach ($data as $key=>$value){
            $record->{$key}=$value;
        }
        return $record->save();
    }
    public static function Index()
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()
                            )
            ->through(
               Title::class
            )
            ->thenReturn()
            ->orderByDesc('created_at')
            ->get();
    }
    static function Builder() : Builder {
        return (new self)->query()->select('*');
    }
    static function Remove($id)
    {
        $record = (new self )->FindByField("id",$id);
        return $record ->delete();
    }

    public static function GetAll()
    {
        return (new self)->query()->get();
    }

    static function AddCode(Insurer $item,$data): \Illuminate\Database\Eloquent\Model
    {
        return TransportationCodeRepository::Add($item,$data);
    }

    static function RemoveCode(Insurer $item)
    {
        return TransportationCodeRepository::Remove($item);
    }


}
