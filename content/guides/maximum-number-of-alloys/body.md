## Search the count

1. For each machine: cost(x) = Σ `max(0, comp[j]·x − stock[j]) · cost[j]`.
2. Binary search x in [0, budget + max(stock)] for the largest cost(x) ≤ budget.
3. Return the best over machines.

Examples → 2, 5, 2. Checked against counting up one alloy at a time on 300 random inputs.

Clamp at 0: spare stock does not refund money, and without the max example 2 → 52 instead of 5. All alloys use one machine, so never mix them.

Time: O(k · n · log(budget + stock))  
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
