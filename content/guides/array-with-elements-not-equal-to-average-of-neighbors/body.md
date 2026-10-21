## Zig-zag

1. Sort; `h = ceil(n / 2)`.
2. Output `a[0], a[h], a[1], a[h + 1], …`.

`[1,2,3,4,5]` → `[1,4,2,5,3]` (any valid answer is accepted). `[6,2,0,9,7]` → `[0,7,2,9,6]`. Checked on random distinct arrays.

Distinct values make the zig-zag strict: a local peak or valley differs from the mean of its neighbours. Swapping adjacent pairs in sorted order is another valid construction.

Time: O(n log n)  
Space: O(n)

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
