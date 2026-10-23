## Tiny example

Greedy pattern cues:

| Pattern | Key |
|---------|-----|
| Interval scheduling | earliest end |
| Jump game | farthest reachable |
| Gas station | net tank / start index tricks |
| Huffman-ish | combine smallest first |

Example jump game on `[2,3,1,1,4]`: track `farthest`; if index `i` passes farthest, fail; else update with `i+nums[i]`.


## How

1. Match cue to selection key
2. Maintain a running best (farthest, tank, …)
3. Prove or cite the pattern


## Trap

Using earliest-end scheduling logic on jump game.

**Fix:** Different problems, different keys.

**Time:** usually O(n) or O(n log n)

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
