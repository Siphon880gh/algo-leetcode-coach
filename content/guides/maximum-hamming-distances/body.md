You are given an array of integers that all fit in a stated number of bits. For each element, return the largest Hamming distance (number of differing bits) between it and any element of the array. Limits are in the official statement. For instance, with 4 bits, [9, 12, 9, 11] → [2, 3, 2, 3]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS on the hypercube

This assumes the bit width m is small enough to visit all 2^m masks; check the official statement.

1. dist[v] = 0 for every value in the array; BFS, flipping one bit per step.
2. answer[i] = m − dist[nums[i] XOR (2^m − 1)].

Constructed checks (run in code, m = 4): [9, 12, 9, 11] → [2, 3, 2, 3]; [3, 4, 6, 10] → [3, 3, 2, 3]. 360 random arrays match comparing every pair.

Comparing every pair costs O(n²); the BFS cost does not grow with n beyond the input.

Time: O(2^m · m + n)  
Space: O(2^m)

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
