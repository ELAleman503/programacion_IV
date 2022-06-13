@extends('layouts.app')

@section('content')
<div class="col-md-12 text-dark relative overflow-y-auto p-0 m-0 h-100">
    <div class="col-md-12 p-0 m-0 h-100">
        <div class="h-100" :class="{'d-none': !tabs['main'].mostrar}">
            <v-main v-bind:tab="tabs" ref="main" v-if="tabs['main'].mostrar" class="p-0" :chat="prop"></v-main>
        </div>
        <div class="h-100" :class="{'d-none': !tabs['solicitud'].mostrar}">
            <v-solicitud v-bind:tab="tabs" ref="solicitud" v-if="tabs['solicitud'].mostrar" class="p-0"></v-solicitud>
        </div>
        <div class="h-100" :class="{'d-none': !tabs['buscar'].mostrar}">
            <v-buscar v-bind:tab="tabs" ref="buscar" v-if="tabs['buscar'].mostrar"></v-buscar>
        </div>
        <!-- <div class="h-100" :class="{'d-none': !tabs[''].mostrar}">
        </div> -->
    </div>
</div>
@endsection
