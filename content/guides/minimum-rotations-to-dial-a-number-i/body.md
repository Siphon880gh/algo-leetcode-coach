## Example first

s = "0192837465", pointer starts on 0.

| From | To | Up | Down | Cost |
|------|----|----|------|------|
| 0 | 0 | 0 | 0 | 0 |
| 0 | 1 | 1 | 9 | 1 |
| 1 | 9 | 8 | 2 | 2 |
| 9 | 2 | 3 | 7 | 3 |
| 2 | 8 | 6 | 4 | 4 |

The rest cost 5, 4, 3, 2 and 1. Total 25.

## Steps

1. pre = 0.
2. For each digit c: d = |c − pre|, add min(d, 10 − d), then pre = c.
3. Return the total.

## Trap

Turning one way only. Example 1 then gives 45 instead of 25. Fix: take min(d, 10 − d).

Checked: both examples match.

Time: O(n)  
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
