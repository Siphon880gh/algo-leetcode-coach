## Count from 1971

1. `days = Σ (366 if leap(y) else 365)` for `y` in `1971..year − 1`.
2. Add the lengths of the months before `month` (29 for February in a leap year), then `day − 1`.
3. `names = ["Friday","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"]`; return `names[days % 7]`.

Leap: divisible by 4, and not by 100 unless by 400 (2100 is not a leap year).

`31/8/2019` → "Saturday". `18/7/1999` → "Sunday".

Do not forget the − 1 on the day; 1971-01-01 itself is offset 0. Do not treat 2100 as a leap year.

Time: O(year − 1971)  
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
