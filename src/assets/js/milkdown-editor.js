import { Crepe } from "@milkdown/crepe";
import "@milkdown/crepe/theme/common/style.css";
import "@milkdown/crepe/theme/frame-dark.css";
import { listener, listenerCtx } from '@milkdown/kit/plugin/listener';

export function initMilkdown(textareaId, milkdownId, markdownText) {
    const crepe = new Crepe({
        root: '#' + milkdownId,
        defaultValue: markdownText,
    });

    crepe.create().then(() => {
        // Находим textarea для синхронизации
        const textarea = document.getElementById(textareaId);
        if (!textarea) {
            console.error("Textarea with id '" + textareaId + "' not found");
            return;
        }

        // Подписываемся на события обновления редактора через listener плагин
        crepe.editor.action((ctx) => {
            const listenerManager = ctx.get(listenerCtx);
            listenerManager.markdownUpdated((ctx, markdown, prevMarkdown) => {
                if (markdown !== prevMarkdown) {
                    if (textarea.value !== markdown) {
                        textarea.value = markdown;
                    }
                }
            });
        });

        // Добавляем обработчик изменений textarea для обратной синхронизации
        textarea.addEventListener('input', () => {
            const markdown = textarea.value;
            // Проверяем, отличается ли содержимое редактора от textarea
            if (crepe.getMarkdown() !== markdown) {
                // crepe.editor.action(insert(markdown));
            }
        });
    });
    
    // Экспортируем редактор в глобальную область видимости для возможного использования вне функции
    window.milkdownEditor = crepe;
}

// Экспорт функции в глобальную область видимости
window.initMilkdown = initMilkdown;