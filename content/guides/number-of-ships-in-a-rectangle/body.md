Ships sit at integer points in a rectangle, at most a small number of them (10 in the usual version). You can only call `Sea.hasShips(topRight, bottomLeft)`, which says whether any ship lies inside a rectangle, and the number of calls is limited. Return the number of ships in the given rectangle. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Split only where ships are

```python
def countShips(sea, tr, bl):
    if bl.x > tr.x or bl.y > tr.y or not sea.hasShips(tr, bl):
        return 0
    if tr.x == bl.x and tr.y == bl.y:
        return 1
    mx, my = (tr.x + bl.x) // 2, (tr.y + bl.y) // 2
    return (countShips(sea, Point(mx, my), bl)
          + countShips(sea, Point(tr.x, my), Point(mx + 1, bl.y))
          + countShips(sea, Point(mx, tr.y), Point(bl.x, my + 1))
          + countShips(sea, tr, Point(mx + 1, my + 1)))
```

Each ship causes about 4 calls per level and there are about log(side) levels, so with few ships the call count stays small.

Do not scan every point; the area can be huge. Do not split into overlapping quadrants; a ship on a border would be counted twice.

Time: O(ships · log(side)) calls  
Space: O(log(side)) recursion

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
