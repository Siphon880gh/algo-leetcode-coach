## Two sides of q

1. Sort `nums`; `pre[i]` is the sum of the first i values.
2. For each `q`: `k` = number of values `< q` (binary search).
3. Answer `q · k − pre[k] + (pre[n] − pre[k]) − q · (n − k)`.

Examples → [14,10], [20]. Checked against summing |x − q| directly on 200 random cases.

Each answer can reach 10^5 · 10^9 = 10^14, so use 64-bit. Answering each query directly would be 10^10 steps.

Time: O((n + m) log n)  
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
