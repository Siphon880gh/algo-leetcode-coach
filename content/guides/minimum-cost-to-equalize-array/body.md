## Enumerate the target

1. If cost2 ≥ 2 · cost1: answer (n · max − sum) · cost1.
2. Else for t = max … 2 · max: total = n · t − sum, g = t − min.
   - 2g ≤ total: ⌊total / 2⌋ · cost2 + (total mod 2) · cost1.
   - else: (total − g) · cost2 + (2g − total) · cost1.
3. Take the minimum, then reduce mod 10^9 + 7 (compare before reducing).

Examples → 15, 6, 4. Checked against a shortest-path search over states on 250 random small arrays.

Stopping at t = max fails: [1, 3, 3], cost1 = 10, cost2 = 1 → 20 instead of 4 (reached at t = 5).

Raw costs reach about 10^17; 64-bit holds them.

Time: O(n + max)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
