## Layer → list → layer

1. For each layer `L`: collect cells clockwise from the top-left.
2. Counter-clockwise movement means each cell takes the value of the next cell clockwise, so the list shifts left by `s = k mod len`.
3. Write the shifted values back in the same cell order.

`[[40,10],[30,20]], 1` → `[[10,20],[40,30]]`. The 4 × 4 example with `k = 2` matches too.

Reduce `k` modulo each layer's length; k reaches 10^9. Different layers have different lengths, so reduce per layer.

Time: O(m · n)  
Space: O(m + n) per layer

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
