Break n locks in any order with a sword whose energy starts at 0 and grows by a factor X every minute, with X starting at 1. A lock breaks once the energy reaches its strength; then the energy resets to 0 and X goes up by 1. Return the least total time. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Locks to positions

This assumes n is too large for a bitmask over subsets (as in part I); check the official limits.

1. cost[i][j] = ⌈strength[i] / (j + 1)⌉ for position j = 0 … n − 1.
2. Minimum-cost perfect matching (Hungarian method, O(n³)).

Constructed check (run in code): [2, 4, 3] → 5. Checked against every order on 400 random cases; n = 80 runs in well under a second.

Breaking the weakest locks first: [2, 4, 3] → 6 instead of 5.

Time: O(n³)  
Space: O(n²)

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
