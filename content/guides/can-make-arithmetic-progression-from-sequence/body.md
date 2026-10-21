## Equal gaps

1. Sort; `d = a[1] − a[0]`.
2. Return whether `a[i] − a[i−1] == d` for all i.

`[3,5,1]` → true. `[1,2,4]` → false.

O(n): `d = (max − min) / (n − 1)` must be an integer; with d = 0 all values must be equal; otherwise each `(x − min)/d` index must be distinct and integral.

Do not check gaps without sorting.

Time: O(n log n)  
Space: O(1) extra

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
