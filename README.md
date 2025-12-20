# Context Menu

A right-click context menu component for Laravel applications. Custom menus on any element. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/context-menu
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-context-menu>
    <x-slot name="trigger">
        <div class="p-4 border rounded">Right-click here</div>
    </x-slot>

    <button class="block w-full px-4 py-2 text-left hover:bg-gray-100">Edit</button>
    <button class="block w-full px-4 py-2 text-left hover:bg-gray-100">Delete</button>
</livewire:sb-context-menu>
```

### With Dividers

```blade
<livewire:sb-context-menu>
    <x-slot name="trigger">
        <div>Right-click for options</div>
    </x-slot>

    <button>Cut</button>
    <button>Copy</button>
    <button>Paste</button>
    <hr class="my-1">
    <button>Delete</button>
</livewire:sb-context-menu>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `disabled` | boolean | `false` | Disable context menu |

## Vue 3 Usage

### Setup

```javascript
import { SbContextMenu, SbContextMenuItem } from './vendor/sb-context-menu';
app.component('SbContextMenu', SbContextMenu);
app.component('SbContextMenuItem', SbContextMenuItem);
```

### Basic Usage

```vue
<template>
  <SbContextMenu>
    <template #trigger>
      <div class="p-8 border-2 border-dashed rounded-lg text-center">
        Right-click anywhere in this area
      </div>
    </template>

    <SbContextMenuItem @click="handleEdit">Edit</SbContextMenuItem>
    <SbContextMenuItem @click="handleDuplicate">Duplicate</SbContextMenuItem>
    <SbContextMenuItem @click="handleDelete" variant="danger">
      Delete
    </SbContextMenuItem>
  </SbContextMenu>
</template>

<script setup>
const handleEdit = () => console.log('Edit');
const handleDuplicate = () => console.log('Duplicate');
const handleDelete = () => console.log('Delete');
</script>
```

### With Icons

```vue
<template>
  <SbContextMenu>
    <template #trigger>
      <div class="p-4 bg-gray-100 rounded">Right-click me</div>
    </template>

    <SbContextMenuItem icon="pencil">Edit</SbContextMenuItem>
    <SbContextMenuItem icon="copy">Duplicate</SbContextMenuItem>
    <SbContextMenuItem icon="download">Download</SbContextMenuItem>
    <hr class="my-1" />
    <SbContextMenuItem icon="trash" variant="danger">Delete</SbContextMenuItem>
  </SbContextMenu>
</template>
```

### File Browser Example

```vue
<template>
  <div class="grid grid-cols-4 gap-4">
    <SbContextMenu v-for="file in files" :key="file.id">
      <template #trigger>
        <div class="p-4 border rounded text-center cursor-pointer hover:bg-gray-50">
          <FileIcon :type="file.type" />
          <p class="mt-2 text-sm truncate">{{ file.name }}</p>
        </div>
      </template>

      <SbContextMenuItem @click="open(file)">Open</SbContextMenuItem>
      <SbContextMenuItem @click="rename(file)">Rename</SbContextMenuItem>
      <SbContextMenuItem @click="download(file)">Download</SbContextMenuItem>
      <hr class="my-1" />
      <SbContextMenuItem @click="deleteFile(file)" variant="danger">
        Delete
      </SbContextMenuItem>
    </SbContextMenu>
  </div>
</template>
```

### With Submenus

```vue
<template>
  <SbContextMenu>
    <template #trigger>
      <div>Right-click</div>
    </template>

    <SbContextMenuItem>View</SbContextMenuItem>
    <SbContextMenuItem submenu>
      Sort by
      <template #submenu>
        <SbContextMenuItem @click="sort('name')">Name</SbContextMenuItem>
        <SbContextMenuItem @click="sort('date')">Date</SbContextMenuItem>
        <SbContextMenuItem @click="sort('size')">Size</SbContextMenuItem>
      </template>
    </SbContextMenuItem>
    <SbContextMenuItem>Refresh</SbContextMenuItem>
  </SbContextMenu>
</template>
```

### Vue Props (SbContextMenu)

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `disabled` | Boolean | `false` | Disable menu |

### Vue Props (SbContextMenuItem)

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `icon` | String | `null` | Icon name |
| `variant` | String | `'default'` | `default` or `danger` |
| `disabled` | Boolean | `false` | Disable item |
| `submenu` | Boolean | `false` | Has submenu |

### Slots

| Slot | Description |
|------|-------------|
| `trigger` | Element to attach menu to |
| default | Menu items |
| `submenu` | Submenu items |

## Features

- **Right-click Trigger**: Native context menu behavior
- **Positioning**: Auto-positions near cursor
- **Submenus**: Nested menu support
- **Icons**: Optional item icons
- **Variants**: Default and danger styles
- **Click Outside**: Closes on outside click

## Styling

Uses Tailwind CSS:
- White background with shadow
- Hover highlights
- Red text for danger variant
- Smooth animations

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
