## Per query

1. pe = prefix counts of even values in nums.
2. removed(m) = evens among nums[l … min(r, bisect(nums, 2m) − 1)].
3. Binary search m in [k, k + (r − l + 1)] for the first m − removed(m) ≥ k; answer 2m.

Examples → [2, 6, 6], [6, 2, 12], [2, 8]. Checked against walking the even numbers on 1,500 random cases.

Answering 2k: example 1 → [2, 4, 6] instead of [2, 6, 6].

Time: O(q log² n)  
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
