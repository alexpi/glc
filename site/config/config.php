<?php

return [
  'home' => 'projects',
  'hooks' => [
    'file.create:after' => function ($file) {
      if (!in_array($file->extension() , ['gif' , 'jpg' , 'jpeg' , 'png']))
          return true;
  
      return $file->update([
          'w' => $file->width(),
          'h' => $file->height(),
          'o' => $file->orientation()
      ]);
    },
    
    'file.replace:after' => function ($newFile, $oldFile) {
        kirby()->trigger('file.create:after', ['file' => $newFile]);
    }
  ],
  'routes' => [
    [
      'pattern' => 'category',
      'action' => function() {
        $data = kirby()->request()->data();
        $session = kirby()->session();

        $session->remove('category');
        $session->set('category', $data['category']);

        return [
          'category' => $data['category']
        ];
      },
      'method' => 'POST'
    ]
  ],
  'debug' => true
];