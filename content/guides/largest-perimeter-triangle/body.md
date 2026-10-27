## Only consecutive triples matter

Sort `nums` descending. For `i` from 0 to `n − 3`:

- If `nums[i] < nums[i + 1] + nums[i + 2]`, return their sum.

Return 0.

With the longest side `nums[i]` fixed, the two next largest give both the best chance to satisfy the triangle inequality and the largest perimeter. If they fail, any smaller pair fails too, so move on to the next longest side.

Do not check all triples; that is O(n³). Do not use `≤`; a degenerate triangle has zero area.

Time: O(n log n)  
Space: O(1) besides the sort

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
