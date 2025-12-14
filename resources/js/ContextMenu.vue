<template>
  <Teleport to="body">
    <Transition name="fade">
      <div
        v-if="visible"
        ref="menuRef"
        :style="{ position: 'fixed', left: position.x + 'px', top: position.y + 'px' }"
        class="z-50 min-w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 overflow-hidden"
        @click.stop
      >
        <template v-for="(item, index) in items" :key="index">
          <div v-if="item.divider" class="border-t border-gray-200 my-1"></div>
          <button
            v-else
            @click="selectItem(index)"
            :disabled="item.disabled"
            :class="['w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-3', item.disabled && 'opacity-50 cursor-not-allowed']"
          >
            <span v-if="item.icon" class="w-4 h-4 flex-shrink-0" v-html="item.icon"></span>
            <span>{{ item.label }}</span>
            <span v-if="item.shortcut" class="ml-auto text-xs text-gray-400">{{ item.shortcut }}</span>
          </button>
        </template>
      </div>
    </Transition>
  </Teleport>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';

export default {
  name: 'SbContextMenu',
  props: {
    items: { type: Array, default: () => [] },
    target: { type: String, default: null }
  },
  emits: ['select'],
  setup(props, { emit }) {
    const visible = ref(false);
    const position = ref({ x: 0, y: 0 });
    const menuRef = ref(null);

    const open = (x, y) => {
      position.value = { x, y };
      visible.value = true;
    };

    const close = () => {
      visible.value = false;
    };

    const selectItem = (index) => {
      if (!props.items[index]?.disabled) {
        emit('select', { index, item: props.items[index] });
        close();
      }
    };

    const handleContextMenu = (e) => {
      if (props.target) {
        const targetEl = document.querySelector(props.target);
        if (targetEl && targetEl.contains(e.target)) {
          e.preventDefault();
          open(e.clientX, e.clientY);
        }
      }
    };

    const handleClickOutside = (e) => {
      if (menuRef.value && !menuRef.value.contains(e.target)) {
        close();
      }
    };

    const handleEscape = (e) => {
      if (e.key === 'Escape') close();
    };

    onMounted(() => {
      document.addEventListener('contextmenu', handleContextMenu);
      document.addEventListener('click', handleClickOutside);
      document.addEventListener('keydown', handleEscape);
    });

    onUnmounted(() => {
      document.removeEventListener('contextmenu', handleContextMenu);
      document.removeEventListener('click', handleClickOutside);
      document.removeEventListener('keydown', handleEscape);
    });

    return { visible, position, menuRef, selectItem, open, close };
  }
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.15s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>
