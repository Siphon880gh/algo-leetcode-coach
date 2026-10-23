## Tiny example

Array fundamentals on `[4,5,6]`:

- Index `1` → `5` in O(1)
- Insert at `1` shifts `5,6` right — O(n)
- Prefix idea: `pre[i]=pre[i-1]+a[i]` enables range sums later

Foundation for two pointers, sliding windows, and prefix sums.


## How

1. Use index math for reads
2. Budget shifts for inserts
3. Build prefixes when range queries appear


## Trap

Doing many mid-inserts on a huge array when a deque/list splice would do.

**Fix:** Match structure to the update pattern.

**Time:** reads O(1); mid-insert O(n); build prefix O(n)

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
