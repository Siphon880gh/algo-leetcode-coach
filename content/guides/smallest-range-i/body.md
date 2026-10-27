## Only the extremes matter

Each element may move anywhere within `[x − k, x + k]`. The score is decided by the largest and smallest results.

- Move the minimum up by `k` and the maximum down by `k`.
- Every other element lies between them and can be moved into the same range.

So the answer is `max(0, max(nums) − min(nums) − 2k)`.

Do not try combinations of ±k per element; that is a much harder problem (see Smallest Range II, where each element must move by exactly ±k). Do not forget the floor at 0.

Time: O(n)  
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
