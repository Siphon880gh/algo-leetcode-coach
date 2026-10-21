## Check a fixed k

1. Sort tasks and workers. Candidate set: the `k` smallest tasks and the `k` largest workers.
2. Walk those workers from weakest. Push every task `≤ w + strength` onto a deque (in sorted order).
3. If the front task `≤ w`: do it without a pill. Otherwise spend a pill and take the **largest** task in the deque. No pill or empty deque → fail.
4. Binary search the largest `k` that passes.

Examples → 3, 1, 2. Checked against trying every assignment and pill choice on small random inputs.

A worker who needs a pill should spend it on the hardest task it can now reach, saving easier ones for weaker workers. Monotone feasibility (fewer tasks are never harder) justifies the binary search.

Time: O(n log n + m log m + (n + m) log min(n, m))  
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
