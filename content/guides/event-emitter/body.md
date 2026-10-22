## Map of lists

1. `subscribe(e, cb)`: append cb to `m[e]`; return `{ unsubscribe: () => remove cb from m[e] }`.
2. `emit(e, args = [])`: return `(m[e] ?? []).map(f => f(...args))`.

Examples → [[],[emitted,[]],[subscribed],[subscribed],[emitted,[5,6]]] and the other three traces. Checked in Node.

Callbacks are never referentially identical, so removing by identity is safe. An event nobody subscribed to emits an empty array.

Time: O(listeners) per emit or unsubscribe  
Space: O(listeners)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
