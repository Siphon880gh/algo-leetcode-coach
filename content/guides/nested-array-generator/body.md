## Stack of positions

1. `stack = [[arr, 0]]`.
2. While the stack is not empty: take the top `[a, i]`. If `i = a.length`, pop. Otherwise read `v = a[i]`, increase i; push `[v, 0]` if v is an array, else yield v.

Examples → [6,1,3], []. Checked in Node.

A recursive `yield*` version is shorter, but in Node an array nested 10^5 deep makes it throw RangeError, while the stack version handles that depth. The stack also never builds a flattened copy.

Time: O(total elements and arrays)  
Space: O(depth)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
