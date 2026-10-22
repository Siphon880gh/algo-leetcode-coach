## Depth-limited recursion

1. `go(a, d)`: for each `x` in `a`, if `Array.isArray(x)` and `d < n`, call `go(x, d + 1)`; else push `x`.
2. Call `go(arr, 0)` and return the output.

Examples → the original array, the one-level flattening, and the fully flat array. Checked in Node, and against Array.prototype.flat(n).

Top-level elements are at depth 0, so n = 0 changes nothing. Nesting goes up to 1000 levels, which recursion handles; an explicit stack also works.

Time: O(total elements)  
Space: O(total elements)

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
