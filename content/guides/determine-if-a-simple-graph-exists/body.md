Each vertex has a desired degree. Decide whether some simple undirected graph (no self-loops and no repeated edges) has exactly these degrees. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check every prefix

1. If the sum is odd, return false.
2. Sort descending; prefix sums P.
3. For each k: find j, the first index ≥ k with d_j < k (binary search). Right side = k(k − 1) + k · (j − k) + (P[n] − P[j]). If P[k] > right side, return false.
4. Return true.

Constructed checks (run in code): [1, 1] → true; [2, 2, 2] → true; [3, 3, 1, 1] → false; [1, 1, 1] → false. Checked against trying every edge set on 1,500 random sequences.

Only checking that the sum is even: [3, 3, 1, 1] → true instead of false.

Time: O(n log n)  
Space: O(n)

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
