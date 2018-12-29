<?php

function simplify_array($model, $field, $relation)
{
	return array_map(function($item) use ($field) { 
		return $item[$field];

	}, $model->$relation()->get()->toArray());
}