## Map of keys

1. P[i] = sum of the first i elements; cnt = empty map.
2. For each r: if r ≥ 2, add key (capacity[r − 2], P[r − 2] + 2 · capacity[r − 2]). Then add cnt[(capacity[r], P[r])] to the answer.
3. Return the answer.

Examples → 2, 0, 1. Checked against testing every subarray on 3,000 random arrays.

Adding l as soon as r = l + 1 (allowing length 2): constructed check (run in code) [0, 0, 0] → 3 instead of 1.

Time: O(n)  
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
