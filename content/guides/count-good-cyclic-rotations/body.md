## Example first

nums = [1, 2, 3, 4, 5, 6], half size m = 3.

| Rotation | Front sum | Back sum | Good |
|----------|-----------|----------|------|
| [1, 2, 3, 4, 5, 6] | 6 | 15 | no |
| [2, 3, 4, 5, 6, 1] | 9 | 12 | no |
| [3, 4, 5, 6, 1, 2] | 12 | 9 | yes |
| [4, 5, 6, 1, 2, 3] | 15 | 6 | yes |
| [5, 6, 1, 2, 3, 4] | 12 | 9 | yes |
| [6, 1, 2, 3, 4, 5] | 9 | 12 | no |

Answer 3.

## Steps

1. l = sum of the first m values, r = sum of the rest. Count it if l > r.
2. For i = 0 … n − 2: the front loses nums[i] and gains nums[(i + m) mod n]. The back gains nums[i] and loses nums[(i + m) mod n].
3. Count every rotation with l > r.

Use 64-bit sums: values reach 10^9 and halves hold up to 5 × 10^4 of them.

## Trap

Counting ties. In Example 2 every rotation is 3 against 3, so using ≥ gives 4 instead of 0. Fix: good means strictly greater.

Checked: examples give 3 and 0, and the slide matched resumming every rotation on 300 random arrays.

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
