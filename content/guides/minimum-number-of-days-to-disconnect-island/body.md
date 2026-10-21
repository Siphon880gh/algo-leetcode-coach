## Check 0, then 1

1. Count islands; if not exactly 1, return 0.
2. For each land cell: remove it, count islands; if not 1 (0 or ≥ 2), return 1; restore.
3. Return 2.

`[[0,1,1,0],[0,1,1,0],[0,0,0,0]]` → 2. `[[1,1]]` → 2 (removing both leaves no island, which counts as disconnected). `[[1,1,1]]` → 1.

Do not search for larger cuts; 2 always suffices. Articulation points (Tarjan) bring step 2 to O(mn).

Time: O((mn)²) brute force  
Space: O(mn)

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
