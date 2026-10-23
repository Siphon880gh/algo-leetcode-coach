## Tiny example

Hash string keys into buckets of size 8.

Naive `hash("cat") = sum of char codes` might cluster similar words. A better mix (avalanche): scramble bits so `"cat"` and `"cats"` land far apart.

Goal: different keys look **uniformly random** across `0 … capacity-1` after `% capacity`.


## How

1. Map key → integer (language hash / custom)
2. Fold into bucket index (`% capacity` or bitmask if power-of-two)
3. Judge quality by collision rate / load factor, not by “feels random”


## Trap

Using only the low bits of a key (like `key % 100` when keys are multiples of 100) — everything collides.

**Fix:** Mix high bits too; test with realistic key distributions.

**Time:** O(1) to compute a typical hash · **Space:** O(1)

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
