## Choose at each 0

`ones = 0`, `flips = 0`. For each character:

- `'1'`: `ones += 1` (a 1 at the end of a monotone prefix is fine).
- `'0'`: `flips = min(flips + 1, ones)`.

Return `flips`.

`flips + 1` keeps the prefix's best answer and turns this 0 into a 1. `ones` instead turns every earlier 1 into 0, so the prefix is all 0s.

The prefix-sum view gives the same answer: try every split point and add (ones on the left) + (zeros on the right).

Do not only count 0s after the first 1; sometimes flipping a few 1s is cheaper. Do not try all 2ⁿ strings.

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
