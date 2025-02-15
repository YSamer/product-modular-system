<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\ProductFeature\Models\Category;
use Nwidart\Modules\Facades\Module;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $formSchema = [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextArea::make('description')->required(),
            Forms\Components\TextInput::make('price')->numeric()->required(),
            Forms\Components\FileUpload::make('image')->image()->nullable(),
        ];

        if (Module::isEnabled('ProductFeature')) {
            $formSchema[] = Forms\Components\TextInput::make('discount')->numeric()->nullable();
            $formSchema[] = Forms\Components\FileUpload::make('image2')->image()->nullable();
            $formSchema[] = Forms\Components\Select::make('category_id')
                ->label('Category')
                ->searchable()
                ->options(Category::all()->pluck('name', 'id'))
                ->nullable();
        }
        return $form->schema($formSchema);
    }

    public static function table(Table $table): Table
    {
        $tableColumns = [
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('price'),
            Tables\Columns\ImageColumn::make('image'),
        ];

        // Add discount and image2 columns only if the ProductFeature module is enabled
        if (Module::isEnabled('ProductFeature')) {
            $tableColumns[] = Tables\Columns\TextColumn::make('discount');
            $tableColumns[] = Tables\Columns\ImageColumn::make('image2');
            $tableColumns[] = Tables\Columns\TextColumn::make('category_id');
        }
        return $table
            ->columns($tableColumns)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
