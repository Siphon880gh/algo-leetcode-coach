## Merge chunks a small value reaches into

For each `x`:

- If the stack is empty or `x ≥ top`, push `x`: it can be its own chunk.
- Otherwise, `m = pop()` (the current chunk's max). While the stack is non-empty and `top > x`, pop. Push `m`: all those chunks merged into one whose max is `m`.

The stack stays non-decreasing, and its size is the number of chunks.

**Prefix and suffix view:** a cut after index `i` is valid when `max(arr[0..i]) ≤ min(arr[i+1..])`. Count the valid cuts plus 1.

Duplicates are why this differs from problem 769; comparisons use `≥` and `>` carefully so equal values may sit in separate chunks.

Do not compare with sorted positions as in problem 769; values can repeat and are not a permutation. Do not pop on equal values; `[2,2]` can be two chunks.

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
