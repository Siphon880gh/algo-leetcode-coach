## Persistent tree

1. bad = prefix count of i with nums[i] % k ≠ nums[i − 1] % k. If the range has one, answer −1.
2. Build persistent versions over the ranks of q, each node with count and sum.
3. Query: walk versions r + 1 and l for the ⌈m/2⌉-th smallest, collecting the count c and sum s below it.
4. Answer med · c − s + (total − s) − (m − c) · med.

Examples → [1, 2], [−1, 0, 1]. Checked against trying every target on 1,500 random cases.

Using the rounded mean: constructed check (run in code) [9, 5, 5], k = 1 → 5 instead of 4.

Time: O((n + q) log n)  
Space: O(n log n)

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
