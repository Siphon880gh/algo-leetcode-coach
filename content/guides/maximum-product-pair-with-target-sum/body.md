## Example first

nums = [−3, −1, 4, 2], target = 1.

| Pair (i, j) | Values | Product |
|-------------|--------|---------|
| (2, 0) | 4, −3 | −12 |
| (3, 1) | 2, −1 | −2 |

−2 > −12, so the answer is [3, 1].

## Steps

1. Scan i from left to right with x = nums[i] and partner y = target − x.
2. Skip x = y: the pair needs nums[i] > nums[j].
3. If y was seen at index j and x · y beats the best product, record [i, j] if x > y, else [j, i].
4. Store pos[x] = i.
5. Return the best pair, or [−1, −1].

## Trap

Comparing absolute products. Example 2 then picks (4, −3) and returns [2, 0] instead of [3, 1]. Fix: compare the signed products.

Checked: the examples match, and the scan matched trying every pair on 300 random arrays.

Time: O(n)  
Space: O(n)

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
