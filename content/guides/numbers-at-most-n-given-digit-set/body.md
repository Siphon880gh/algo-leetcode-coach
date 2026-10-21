## Count by length

Let `s = str(n)`, `L = len(s)`, `d = len(digits)`.

1. Shorter numbers: `ans = d + d² + … + d^(L − 1)`.
2. Same length, left to right for position `i`:
   - `smaller` = allowed digits less than `s[i]`. Add `smaller · d^(L − 1 − i)`: any digits may follow.
   - If `s[i]` is allowed, continue to the next position (match it exactly). Otherwise stop.
3. If every digit of `n` was allowed, add 1 for `n` itself.

Return `ans`.

The digits are 1–9 only, so no number has leading zeros to worry about.

Do not generate the numbers; with n up to 10⁹ and nine digits that is too many. Do not forget the final +1 when `n` itself can be formed.

Time: O(L · d)  
Space: O(L)

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
