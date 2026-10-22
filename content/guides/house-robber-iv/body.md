## Search plus greedy

1. `ok(c)`: walk left to right; when `nums[i] ≤ c`, count it and skip `i + 1`; else move on. Return `count ≥ k`.
2. Binary search the smallest `c` in `[min(nums), max(nums)]` with `ok(c)`.

Examples → 5, 2. Checked against trying every set of houses on 300 random arrays.

Taking the leftmost allowed house never hurts: any choice that skips it can swap its first house for this one. A larger c only allows more houses, so ok is monotone.

Time: O(n log max)  
Space: O(1)

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
