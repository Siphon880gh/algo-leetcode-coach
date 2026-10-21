## Two recursions

1. `match(h, t)`: if `h` is null, true; if `t` is null or values differ, false; else `match(h.next, t.left) or match(h.next, t.right)`.
2. `isSub(h, t)`: if `t` is null, false; return `match(h, t) or isSub(h, t.left) or isSub(h, t.right)`.

With the example tree: `[4,2,8]` → true, `[1,4,2,6]` → true, `[1,4,2,6,8]` → false.

Do not restart the match in the middle of a path; a failed match returns to `isSub`, which tries new starts. Do not allow upward or sideways moves; paths go down only.

Time: O(n · m) worst case  
Space: O(height)

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
