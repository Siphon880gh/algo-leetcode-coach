## Divisors come in pairs

If `i` divides `num`, so does `num / i`, and one of the two is at most `sqrt(num)`. Start `s = 1` (1 divides every `num > 1`), loop `i` from 2 while `i * i <= num`, and on `num % i == 0` add `i` and `num / i` — only once when `i * i == num`. Return `s == num`.

`num = 1` has no proper divisors, so its sum is 0, not 1: return false up front.

Only five perfect numbers are at most 1e8 (6, 28, 496, 8128, 33550336), so a lookup also works, but the loop is the skill.

Do not loop to `num − 1` — 1e8 steps per call is wasteful. Do not add a square root divisor twice.

Time: O(sqrt(num))  
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
