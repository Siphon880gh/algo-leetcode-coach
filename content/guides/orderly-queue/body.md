## Two very different cases

**k = 1.** Each move takes the first letter to the back: a rotation. Try all `n` rotations `s[i:] + s[:i]` and return the smallest.

**k ≥ 2.** You can hold one letter aside by moving the other of the first two to the back, which lets you swap adjacent letters in effect. Adjacent swaps reach every permutation, so return `sorted(s)`.

Do not simulate moves for k ≥ 2; the answer is just the sorted string. Do not sort when k = 1; most orders are unreachable.

Time: O(n²) for k = 1, O(n log n) otherwise  
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
