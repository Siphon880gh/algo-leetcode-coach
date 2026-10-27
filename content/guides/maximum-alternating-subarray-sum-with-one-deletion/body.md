## Example first

nums = [10, −5, −100].

1. Without deleting, the best subarray is [−5, −100]: −5 − (−100) = 95.
2. Delete −5 to get [10, −100]: 10 − (−100) = 110.

Answer 110.

## States ending at index i

| State | Sign of nums[i] | Deletion used |
|-------|-----------------|---------------|
| e0 | + | no |
| o0 | − | no |
| e1 | + | yes |
| o1 | − | yes |

## Steps

1. e0[i] = nums[i] + max(0, o0[i − 1]): start fresh or extend.
2. o0[i] = −nums[i] + e0[i − 1].
3. e1[i] = nums[i] + max(o1[i − 1], o0[i − 2]): the second option deletes nums[i − 1].
4. o1[i] = −nums[i] + max(e1[i − 1], e0[i − 2]).
5. The answer is the largest value of any state at any index.

Deleting an end of the chosen subarray never helps, so the deleted element always sits inside, right before index i.

## Trap

Never deleting. Example 2 then gives 95 instead of 110. Fix: add the two deletion states.

Checked: the examples give 11, 110 and 7, and the states matched trying every deletion and subarray on 300 random arrays.

Time: O(n)  
Space: O(1) with rolling variables

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
