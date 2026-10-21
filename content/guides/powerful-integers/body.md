## Two short loops

```
res = set()
a = 1
while a <= bound:
    b = 1
    while a + b <= bound:
        res.add(a + b)
        if y == 1: break
        b *= y
    if x == 1: break
    a *= x
```

Return `list(res)`.

When the base is 1, every power is 1, so the inner or outer loop would run forever without the break.

Do not loop over all numbers up to the bound and test them. Do not forget the set; different pairs can give the same sum.

Time: O(log_x bound · log_y bound)  
Space: O(number of results)

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
