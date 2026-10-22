## Nested Maps

1. `root = new Map()`; a unique Symbol marks the stored result.
2. On a call: walk from `root` through `args.length`, then each argument, creating Maps as needed.
3. If the final node has no result, store `fn(...args)`; return it.

Examples → calls 1, 1, 2; three separate {} pairs make 3 calls; the same object twice makes 1. Checked in Node.

Map keys use SameValueZero, which matches === for objects and numbers apart from NaN. Starting with the count keeps f(1) and f(1, undefined) apart.

Time: O(arguments) per call  
Space: O(total stored arguments)

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
