Given a time `"HH:MM"`, return the next time (wrapping past midnight if needed) that uses only the digits in the given time; each digit may be reused any number of times. If no other time works, the answer is the same time a full day later. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Enumerate, don't step

1. Collect the digit set `D` (at most 4 digits).
2. For every `h1, h2, m1, m2` in `D`: skip if `10·h1 + h2 ≥ 24` or `10·m1 + m2 ≥ 60`.
3. `gap = (cand − cur) mod 1440`, with `gap = 1440` when it is 0, so the input itself counts as a full day later.
4. Return the candidate with the smallest gap.

You can also step forward one minute at a time (at most 1440 steps) and stop at the first time whose digits are all in `D`. Both are constant time.

Do not try to fix the digits from the right greedily without care; the greedy works (replace the rightmost digit with the next larger allowed digit within its limit, and reset the later digits to the smallest digit) but is easy to get wrong. Do not forget the wrap: `"23:59"` → `"22:22"`.

Time: O(1)  
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
