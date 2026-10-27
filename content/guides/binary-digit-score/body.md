## Example first

a = 5, b = 15.

1. 5 = 101, so s1 = 2.
2. 15 = 1111, so s2 = 4.
3. s1 < s2, so the score is 4 / 2 = 2.

## Steps

1. s1 = set bits of a, s2 = set bits of b.
2. If s1 ≥ s2, return s1 · s2.
3. Otherwise return s2 / s1 with integer division. a ≥ 1, so s1 is never 0.

## Trap

Always multiplying. Example 2 then gives 8 instead of 2. Fix: multiply only when s1 ≥ s2.

Checked: all three examples match.

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
