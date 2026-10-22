## Clear and reset

1. `let id`.
2. Return `(...args) => { clearTimeout(id); id = setTimeout(() => fn(...args), t); }`.

Examples → [{t: 125, inputs: [2]}], [{t: 70, inputs: [1]}, {t: 120, inputs: [2]}], [{t: 200, inputs: [1,2]}, {t: 450, inputs: [5,6]}]. Checked in Node with real timers.

Clearing an id that already fired, or is undefined, does nothing, so no extra checks are needed.

Time: O(1) per call  
Space: O(1)

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
