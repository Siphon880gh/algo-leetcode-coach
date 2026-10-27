## Valid numbers from a digit string t

- Length 1: just `t`.
- Starts and ends with `0` (length > 1): none; `"00"` or `"0.0"` are never valid.
- Starts with `0`: only `"0." + t[1:]`.
- Ends with `0`: only `t` itself (a decimal would end in 0).
- Otherwise: `t`, plus `t[:i] + "." + t[i:]` for every `i` from 1 to `len(t) − 1`.

For each split point of the inner digits, combine every valid `x` with every valid `y` as `"(x, y)"` (with a space after the comma).

Do not allow leading zeros like `"01"` or `"00.5"`, or trailing zeros after a decimal point like `"1.10"`. Do not forget the space in the output format.

Time: O(n³) for building the strings  
Space: O(n³) for the output

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
