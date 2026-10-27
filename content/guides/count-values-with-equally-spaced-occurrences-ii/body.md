## Example first

nums = [8, 8, 8, 8]. Value 8 sits at 0, 1, 2, 3. Every gap is 1 and there are at least three copies, so 8 is special. Answer 1.

nums = [8, 6, 6, 8, 8]. Value 8 sits at 0, 3, 4 with gaps 3 and 1, and 6 appears only twice. Answer 0.

## Steps

1. Walk nums once and append each index to the list for its value.
2. Skip lists shorter than 3.
3. Let d = p1 − p0. The value is special when every later gap also equals d.
4. Count those values. The lists add up to n, so the checks are O(n) in total.

## Trap

Checking only the first three copies. In [7, 7, 7, 1, 7] the value 7 sits at 0, 1, 2, 4: the first three look even, but the last gap is 2. Checking three copies gives 1 instead of 0. Fix: compare every gap.

Checked: the examples give 2, 1 and 0, and the scan matched a direct check per value on 300 random arrays.

Time: O(n)  
Space: O(n)

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
