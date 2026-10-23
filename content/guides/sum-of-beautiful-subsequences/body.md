## Per divisor

1. For each element, add it to the list of every divisor of its value (keeping index order).
2. For each g: walk its list; the subsequences ending at x = 1 + (sum over smaller values so far), via a Fenwick tree on the compressed values. cnt[g] = their total.
3. For g from max down to 1: exact[g] = cnt[g] − Σ exact[2g, 3g, …].
4. Return Σ g · exact[g] mod 10^9 + 7.

Examples → 10, 12. Checked against listing every increasing subsequence on 800 random arrays.

Skipping the subtraction (Σ g · cnt[g]): example 1 → 12 instead of 10.

Time: O(Σ d(nums[i]) · log n + V log V), V = max(nums)  
Space: O(Σ d(nums[i]) + V)

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
