## Tiny example

Each greedy problem has its own key for choosing:

| Pattern | Key |
|---------|-----|
| Interval scheduling | earliest end |
| Jump game | farthest reachable index |
| Gas station | running fuel balance, and where to restart |
| Huffman-style merging | combine the smallest items first |

Example, jump game on `[2,3,1,1,4]`: keep track of `farthest`. If index `i` is beyond `farthest`, you fail. Otherwise, update `farthest` with `i + nums[i]`.

## How

1. Match the problem's clue to a key for choosing.
2. Keep a running best value, such as the farthest index or the fuel balance.
3. Prove the rule, or rely on a known pattern.

## Trap

Using the earliest-end logic from interval scheduling on the jump game.

**Fix:** Different problems need different keys.

**Time:** usually O(n) or O(n log n)

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
