## Three ways to trim

1. Sort `nums`.
2. Return `min(a[n − 3] − a[0], a[n − 1] − a[2], a[n − 2] − a[1])`.

Examples → 3, 0. Checked against trying every pair of changes on 200 random small arrays.

Setting a changed value equal to a remaining one gives a duplicate, so the low score is 0 without widening the range. Only the two smallest and two largest are worth changing.

Time: O(n log n)  
Space: O(1) besides sorting

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
