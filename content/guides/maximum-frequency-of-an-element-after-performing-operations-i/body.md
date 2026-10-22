## Scan targets

1. cnt[v] and its prefix sums over 0 … max + k.
2. For each x: c = elements in [x − k, x + k]; freq = cnt[x] + min(numOperations, c − cnt[x]).
3. Answer the maximum.

Examples → 2, 2. Checked against trying every target on 400 random cases.

Only trying values already in nums: [1, 5], k = 2, numOperations = 2 → 1 instead of 2 (target 3).

Time: O(n + max + k)  
Space: O(max + k)

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
