## Example first

nums = [6, 5, 2, 5, 5, 3, 6].

1. Index 2 (value 2) sits between 5 and 5: a valley.
2. Index 5 (value 3) sits between 5 and 6: a valley.
3. The 5s at indices 3 and 4 touch each other, so neither is strictly above both neighbours.
4. No peaks. Answer 0 − (2 + 3) = −5.

## Steps

1. For i from 1 to n − 2:
2. If nums[i] is greater than both neighbours, add it.
3. If it is smaller than both neighbours, subtract it.
4. Return the total.

## Trap

Using non-strict comparisons. Both 5s then count as peaks, and Example 3 gives 5 instead of −5. Fix: compare strictly.

Checked: all three examples match.

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
