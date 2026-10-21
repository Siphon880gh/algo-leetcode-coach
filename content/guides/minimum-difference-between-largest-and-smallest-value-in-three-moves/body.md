## Four windows

1. If `n ≤ 4`, return 0.
2. Sort; return `min(a[n − 4 + i] − a[i] for i in 0..3)`.

`[5,3,2,4]` → 0. `[1,5,0,10,14]` → 1. `[3,100,20]` → 0.

Do not greedily drop the farthest outlier three times; the choices interact. A partial sort (the 4 smallest and 4 largest) gives O(n).

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
