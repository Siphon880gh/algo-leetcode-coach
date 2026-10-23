## Tiny example

Hash pattern menu:

| Pattern | Sketch |
|---------|--------|
| Two Sum map | value → index while scanning |
| Anagram counts | char → freq |
| Prefix + map | prefix sum → first index / count |
| Group by key | key → list of items |

Example Two Sum `[2,7,11,15]`, target 9: at `7`, need `2` already mapped → pair.


## How

1. Match cue to a row
2. Decide query-before-insert vs insert-before-query
3. Store the value you will need later (index, count, list)


## Trap

Storing the wrong thing in the map (value when you needed index).

**Fix:** Write “map from X to Y” in a comment first.

**Time:** expected O(n) · **Space:** O(n)

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
